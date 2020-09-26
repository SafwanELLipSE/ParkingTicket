<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Parking Ticket</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('custom_css/custom_css.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('custom_js/main.js')}}"></script>
  <body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						            <h2>Manage <b>Parking Cars</b></h2>
          					</div>
          					<div class="col-sm-6">
          						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Parking Ticket</span></a>
          						<a href="#deleteEmployeeModal" class="btn btn-warning" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Parking Loaction</span></a>
          					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
        						    <th>
            							<span class="custom-checkbox">
            								<input type="checkbox" id="selectAll">
            								<label for="selectAll"></label>
            							</span>
            						</th>
                        <th>Name</th>
                        <th>Mobile</th>
						            <th>Car ID</th>
                        <th>Parking Place</th>
                        <th>Otp</th>
                        <th>Status</th>
                        <th>Time Assiged</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($users as $item)
                      <tr>
          						<td>
          							<span class="custom-checkbox">
          								<input type="checkbox" id="checkbox1" name="options[]" value="1">
          								<label for="checkbox1"></label>
          							</span>
          						</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->mobile }}</td>
  				            <td>{{ $item->car_number }}</td>
                      <td>{{ $item->park->name }}</td>
                      <td>{{ $item->otp }}</td>
                      <td>{!! App\Ticket_user::getStatus($item->status) !!}</td>
                      <td>{{ $item->time }} hours</td>
                      <td>{{ $item->total_cost }}</td>
                      <td>
                        @if($item->status != 1)
                          <a href="#editEmployeeModal" data-userid="{{ $item->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">done</i></a>
                        @endif
                          <a href="#userDeleteEmployeeModal" data-userid="{{ $item->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
			       <div class="clearfix">
                <div class="hint-text">Showing <b>{{ count($users) }}</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
          @csrf
					<div class="modal-header">
						<h4 class="modal-title">Create a Parking Ticket</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" required>
						</div>
            <div class="form-group">
							<label>Mobile Number</label>
							<input type="number" name="mobile" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Car Number</label>
							<input type=text name="car_number" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Parking Location</label>
              <select name="parking_location" class="form-control">
                <option value="0"></option>
                @foreach($parking_areas as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
						</div>
            <div class="form-group">
							<label>Hour</label>
							<input type=number name="time" class="form-control" required>
						</div>
            <div class="form-group">
							<label>Cost Per Hour</label>
							<input type=number name="cost" value="60" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
  						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
  						<input type="submit" class="btn btn-success" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('approve') }}" method="POST">
          @csrf
					<div class="modal-header">
						<h4 class="modal-title">Validate with Otp</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>OTP Number</label>
              <input type="hidden" name="user_id" id="user_id" value="">
							<input type="text" name="otp_number" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
  <!-- Delete Modal HTML -->
  <div id="userDeleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('delete') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="user_id" id="user_id" value="">
            <p>Do you Want to Delete This user ??</p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" value="delete">
          </div>
        </form>
      </div>
    </div>
  </div>
	<!-- Add Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('add') }}" method="POST">
          @csrf
					<div class="modal-header">
						<h4 class="modal-title">Add New Parking Location</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
            <div class="form-group">
							<label>Name</label>
							<input type="text" name="name"  class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
  @include('sweetalert::alert')
  <script type="text/javascript">
    $('#editEmployeeModal').on('show.bs.modal', function (event) {
    		var button = $(event.relatedTarget)
    		var user_id = button.data('userid')
    		var modal = $(this)
    		modal.find('.modal-body #user_id').val(user_id);
    })
    $('#userDeleteEmployeeModal').on('show.bs.modal', function (event) {
    		var button = $(event.relatedTarget)
    		var user_id = button.data('userid')
    		var modal = $(this)
    		modal.find('.modal-body #user_id').val(user_id);
    })
    </script>
</body>
</html>
