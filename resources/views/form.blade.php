<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Form Pendaftaran Responden</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Registrasi <small>Responden</small></h2>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                    {{ Session::get('error')}}
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success">
                    {{ Session::get('success')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-6">
                <form action="{{ route('form.save') }}" method="POST" class="">
                    <div class="card">
                        <div class="card-body">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="name" class="col-lg-3 col-form-label">Name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" required @isset($responden) value="{{ $responden->name }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-lg-3 col-form-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control form-control-sm" name="email" id="email" required @isset($responden) value="{{ $responden->email }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-lg-3 col-form-label">Gender</label>
                                <div class="col-lg-9">
                                    <select name="gender" id="gender" class="form-control form-control-sm">
                                        <option value="MALE">Laki-laki</option>
                                        <option value="FEMALE">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="religion" class="col-lg-3 col-form-label">Religion</label>
                                <div class="col-lg-9">
                                    <select name="religion" id="religion" class="form-control form-control-sm">
                                        <option value="ISLAM">Islam</option>
                                        <option value="PROTESTAN">Protestan</option>
                                        <option value="KATOLIK">Katolik</option>
                                        <option value="HINDU">Hindu</option>
                                        <option value="BUDHA">Budha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="birthday" class="col-lg-3 col-form-label">Birthday</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-sm" name="birthday" id="birthday" value="{{ $responden->birthday ?? "" }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="biografi" class="col-lg-3 col-form-label">Biografi</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control form-control-sm" name="biografi" id="biografi">{{ $responden->biografi ?? "" }}</textarea>
                                </div>
                            </div>
        
                        </div>
                        <div class="card-footer">
                            @isset($responden) 
                                <input type="hidden" value="{{ $responden->id }}" name="id">
                            @endisset
                            <button type="submit" class="btn btn-primary">@if(isset($responden)) Update @else Save @endif</button>
                            <button type="reset" class="btn btn-default" onclick="document.location='/form'">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr>

        <div class="row" style="margin-top: 20px">
            <div class="col">
                <table class="table table-bordered">
                    <tr style="font-weight:bold" class="text-center">
                        <td>Name</td>
                        <td>Email</td>
                        <td>Gender</td>
                        <td>Religion</td>
                        <td>Birthday</td>
                        <td>Biografi</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $i)
                    <tr>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->email }}</td>
                        <td>{{ $i->gender == "MALE" ? "Laki-laki" : "Perempuan" }}</td>
                        <td>{{ $i->religion }}</td>
                        <td>{{ $i->birthday }}</td>
                        <td>{{ $i->biografi }}</td>
                        <td>
                            <a href="/form?id={{ $i->id }}">Select</a> | 
                            <a href="/delete/{{ $i->id }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script>
        const gender    = '{{ $responden->gender ?? "" }}';
        const religion  = '{{ $responden->religion ?? "" }}';


        function selectElement(id, valueToSelect) {    
            let element = document.getElementById(id);
            console.log(valueToSelect);
            element.value = valueToSelect;
        }

        if (gender) {
            selectElement("gender", gender);
        }

        if (religion) {
            selectElement("religion", religion);
        }
    </script>

</body>
</html>