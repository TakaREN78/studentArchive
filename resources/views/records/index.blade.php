@extends('layouts.app')

@section('content')
<div class="container">
    <h6>Upload from file</h6>
    <h6><small class="text-muted"><u>Download Excel Template</u></small></h6>

    <div class="row">
        <div class="col mt-3">
            <div class="container">

                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('duplicates'))
                <div class="alert alert-warning mt-3">
                    {{ session('duplicates') }}
                </div>
                @endif

                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" style="flex: 1; margin: 0 5px" class="btn btn-outline-primary">UPLOAD</button>
                        <button type="button" style="flex: 1; margin: 0 5px" class="btn btn-outline-danger" onclick="resetFileInput()">CANCEL</button>
                    </div>
                </form>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('records.index') }}" method="GET" class="form-inline">
                            <div class="form-group mr-2">
                                <label for="class" class="mr-2">Filter by Class:</label>
                                <select name="class" id="class" class="form-control">
                                    <option value="">All Classes</option>
                                    <option value="Berlian" {{ request()->query('class') == 'Berlian' ? 'selected' : '' }}>Berlian</option>
                                    <option value="Delima" {{ request()->query('class') == 'Delima' ? 'selected' : '' }}>Delima</option>
                                    <option value="Zamrud" {{ request()->query('class') == 'Zamrud' ? 'selected' : '' }}>Zamrud</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('records.index') }}" method="GET" class="form-inline float-md-right">
                            <div class="form-group mr-2">
                                <label for="search" class="mr-2">Search:</label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search Student by Name or Contact" value="{{ request()->query('search') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table mt-3 text-muted">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Class</th>
                        <th>Parent Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->level }}</td>
                        <td>{{ $record->class }}</td>
                        <td>{{ $record->parentContact }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <script>
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });

                function resetFileInput() {
                    document.getElementById("customFile").value = "";
                    document.querySelector(".custom-file-label").innerHTML = "Choose file";
                }
            </script>
        </div>
    </div>
</div>
@endsection
