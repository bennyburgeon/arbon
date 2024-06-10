@extends('admin.layout.layout')

@section('body')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
    <h5 class="card-header">Permutation Words List</h5>

    


    <section class="content">
        <div class="col-sm-12"><br>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- text input -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('permutations.store') }}" method="POST" id="cardUpload"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Permutations Word</label>
                            <input type="text" name="word" class="form-control"
                                placeholder="Please enter a Word">
                        </div>
                        

                        
                        
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Search</button>
                         </div>
                        </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#cardUpload').validate({
            rules: {
                title: {
                    required: true
                },
            },
            messages: {
                image: {
                    required: "Please upload an image"
                },
                title: {
                    required: "Enter title"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>


    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
        });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 250,
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
        });


        $('#imageUpload').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#imgCard').css('display', 'block');
                    $('#imgPrev').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script type="text/javascript">
        document.getElementById('salonz').className = 'nav-link active';
    </script>
@endsection
