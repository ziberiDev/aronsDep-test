@extends('app/main')

@section('content')
    <div x-data="csvUploader()">


    <div class="container">
        <div x-bind:class="{ 'd-none': !uploading }" class="position-absolute z-3">
            <img class="img-fluid" src="https://www.superiorlawncareusa.com/wp-content/uploads/2020/05/loading-gif-png-5.gif" alt="">
        </div>
        <div class="row mt-5">

            <div class="col-3 mx-auto">
                <div>
                    <input type="file" class="form-control-file" x-ref="fileInput" @change="file = $refs.fileInput.files[0]; hasFile = true">
                    <button class="btn btn-primary" x-bind:class="{ 'd-none': !hasFile }" @click="uploadFile">Upload</button>
                </div>
            </div>
        </div>
    </div>


    @if($users->count())
        <div class="container">
        <h1>User List</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Company</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->worker}}</td>
                    <td>{{$user->company}}</td>
                    <td><a href="{{route('user.show' , ['id' => $user->id])}}" class="btn btn-secondary">view</a></td>
                </tr>




            @endforeach

            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>

    @endif
    </div>

    <script>

        document.addEventListener('alpine:init', () => {

            window.Alpine.data('csvUploader', () => ({
                file: null,
                hasFile: false,
                uploading: false,
                 uploadData(file) {
                    this.uploading = true
                     let formData = new FormData();
                     formData.append('csv', file);
                     formData.append('_token' , document.querySelector('meta[name="csrf-token"]').content);
                    console.log(file)
                    fetch('/api/save', {
                        method: 'POST',
                        body: formData,
                    })
                        .then(response => {
                            if (response.ok) {
                                console.log('File uploaded successfully.');
                                this.file = null;
                                this.hasFile = false;
                                location.reload();
                            } else {
                                console.error('File upload failed.');
                            }
                            //TODO call users api on init to pull all users from api
                            this.uploading = false
                        })
                        .catch(error => {
                            this.uploading = false
                            console.error('Error occurred during file upload:', error);
                        });

                 },
                uploadFile() {
                    this.uploadData(this.file);
                    this.file = null;
                    this.hasFile = false;
                },
            }));

        });
    </script>
@endsection
