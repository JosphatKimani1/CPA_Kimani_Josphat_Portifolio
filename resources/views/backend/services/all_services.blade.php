@extends('admin.admin_dashboard')
@section('admin')
    
			<div class="page-content">

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">My Quality Services</h6>
        
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Serial No.</th>
                        <th>Title</th>
                        <th>Descprition</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ( $services as $key => $service )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $service->service_title }}</td>
                                <td>{{ $service->service_description }}</td>
                                <td>
                                    <button type="button" class="btn btn-light">Edit</button>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </td>
                               
                            </tr>
                        @endforeach
                      
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>

@endsection