@extends('layouts.app')

@section('admin_content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Category</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <a href="{{ route('category.create') }}" class='btn btn-primary'>Add new</a>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Category name</th>
                      <th>Category slug</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($category as $key => $category)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->slug }}</td>
                      <td>
                        <a href="{{ route('category.edit',$category->id) }}" class='btn btn-info'>Edit</a>
                        <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy',$category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                          
                          </form>
                          <button type='button' class='btn btn-danger' onclick="if(confirm('Are you sure?You want to delete this?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $category->id }}').submit();
                          } else {
                            event.preventDefault();  
                          }">Delete</button>
                      </td>
                    </tr>
                    
                    @endforeach
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection