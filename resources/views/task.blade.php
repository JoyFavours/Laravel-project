@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mt-5 text-right">
            <button class='btn btn-outline-success' style='border-width: 2px;' data-toggle="modal" data-target="#taskModal">Edit</button>
        </div>
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table mt-1 mt-1">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{$task->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Description</strong></td>
                        <td>{{$task->description}}</td>
                    </tr>
                    <tr>
                        <td><strong>Task</strong></td>
                        <td>
                            @if($task->status == 0)
                            <span class='text-muted'>Pending</span>
                            @else
                            <span class='text-success'>Completed</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Date Posted</strong></td>
                        <td>{{\Carbon\Carbon::parse($task->task_date)->diffForHumans()}}</td>
                    </tr>
                    <tr>
                        <td><strong>Action</strong></td>
                        <td>
                            @if($task->status == 0)
                                <a href='{{url("complete/".$task->id)}}' class='btn btn-success btn-sm'>Complete?</a>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('addtask')}}" method="POST">
            @csrf
            <input type='hidden' name='id' value='{{$task->id}}'>
            <div class='form-group'>
                <label>Name</label>
                <input type='text' class='form-control' name='name' placeholder='Task Name' value="{{$task->name}}">
            </div>
            <div class='form-group'>
                <label>Description</label>
                <textarea class='form-control' name='description' rows='4' placeholder='Task Description'>{{$task->description}}</textarea>
            </div>
            <div class='form-group text-right'>
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
@endsection
