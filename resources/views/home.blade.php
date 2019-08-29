@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mt-5 text-right">
            <button class='btn btn-success' data-toggle="modal" data-target="#taskModal">Add Task</button>
        </div>
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table mt-1 mt-1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th class='text-right'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($todo->isEmpty())
                        <tr>
                            <td colspan='5' class='text-center text-danger'>No tasks yet!<td>
                        </tr>
                    @endif
                    @foreach($todo as $task)
                    <tr>
                        <td>{{ Str::words($task->name, 4, '....')}}</td>
                        <td>{!! \Str::words($task->description, 4,'....')  !!}</td>
                        <td>
                            @if($task->status == 0)
                            <span class='text-muted'>Pending</span>
                            @else
                            <span class='text-success'>Completed</span>
                            @endif
                        </td>
                        <td>{{\Carbon\Carbon::parse($task->task_date)->diffForHumans()}}</td>
                        <td class='text-right'>
                            @if($task->status == 0)
                                <a href='{{url("complete/".$task->id)}}' class='btn btn-success btn-sm'>Complete?</a>
                            @endif
                            <a href='{{url("delete/".$task->id)}}' class='btn btn-danger btn-sm'>Delete</a>
                            <a href='{{url("view/".$task->id)}}' class='btn btn-primary btn-sm'>View</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class='mt-1'>
                {{$todo->links()}}
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
            <input type='hidden' name='id' value='0'>
            <div class='form-group'>
                <label>Name</label>
                <input type='text' class='form-control' name='name' placeholder='Task Name'>
            </div>
            <div class='form-group'>
                <label>Description</label>
                <textarea class='form-control' name='description' rows='4' placeholder='Task Description'></textarea>
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
