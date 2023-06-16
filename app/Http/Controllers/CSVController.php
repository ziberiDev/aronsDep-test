<?php

namespace App\Http\Controllers;


use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

class CSVController extends Controller
{

    public function save(Request $request)
    {


        $filePath = $request->file('csv')->getRealPath();
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file); // Read the first row as the header

        $shifts = [];

        while (($row = fgetcsv($file)) !== false) {
            $header = array_map('strtolower', $header);
            $header = array_map('Str::snake', $header);
            $shifts[] = array_combine($header, $row);
        }
        $shifts = LazyCollection::make($shifts);
        fclose($file);

        $curencies = config('curencies');
        $groupedData = $shifts->groupBy(function ($item) {
            return $item['worker'] . '-' . $item['company'];
        });

        $shifts = collect();
         $groupedData->eager()->each(function ($items) use ($curencies ,&$shifts) {
            $user = User::query()->updateOrCreate([
                'slug' => $items[0]['worker'] . $items[0]['company'],
                'worker' => $items[0]['worker'],
                'company' => $items[0]['company'],
            ]);

            foreach ($items as $shift) {
                unset($shift['worker']);
                unset($shift['company']);
                $shift['rate_per_hour'] = str_replace(
                    $curencies,
                    '',
                    $shift['rate_per_hour']
                );
                $shift['total_pay'] = ((int)$shift['hours'] * (float) $shift['rate_per_hour']);

                $shift['user_id'] = $user->id;
                $shift['created_at'] = now();
                $shift['updated_at'] = now();
                $shifts->push($shift);

            }
        });


         $shifts->chunk(1000)->each(function ($shift){
                    Shift::query()->upsert($shift->toArray() , ['user_id' , 'date']);
         });

         return response()->json(['success' => 'true'] ,  200);

}
}
