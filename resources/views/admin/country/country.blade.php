@extends('admin.layouts.app')

@section('content')
 @php
    $html = '';
    @endphp
    @foreach ($countries as $country)
        @php
        $html .= '
        <tr role="row">
            <td>' . $country->{'id'} . '</td>
            <td>' . $country->{'name'} . '</td>
            <td><a href="delete/'.$country->id.'">Delete</a></td>
        </tr>';
        @endphp
    @endforeach
        
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            {!! $html !!}
                        </tbody>
                    </table>
                   <button class="btn btn-success"><a href="add-country" style="color: white;font-weight: bold;">ADD COUNTRY</a></button>
                </div>
                

@endsection
 
