@extends('layouts.app')

@section('title', 'Reports | Revenue Report')

@section('content')
    <div class="row pages">
        <div class="col-lg-3">
            <div class="card card shadow p-4">
             <div class="card-body form-numbers">
                 <h5 class="mb-4">Date Range</h5>
                 <form>
                    <div class="form-group">
                        <label>From</label>
                        <input type="date" class="form-control" name="from" @if(isset($_GET['from']) || isset($_GET['to']))value="{{$_GET['from']}}" @else value="{{date('Y-m-d')}}" @endif>
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="date" class="form-control" name="to" @if(isset($_GET['from']) || isset($_GET['to']))value="{{$_GET['to']}}" @endif>
                    </div>
                    <button type="submit" class="btn text-white">Generate</button>
                 </form>
             </div>
            </div>
         </div>
        <div class="col-lg-9">
            <div class="card shadow p-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="text-tertiary">Report</h4>
                    @if($reports->count() > 0)
                        @if(isset($_GET['from']) && isset($_GET['to'])) 
                            <a href="/reports/export/revenue-report/{{$_GET['from']}}/{{$_GET['to']}}" class="btn btn-sm text-light d-flex align-items-center"><i class="fas fa-file-export mr-2"></i><span>Export</span></a>
                        @else
                            Select date range to export
                        @endif
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Form Date</th>
                                    <th>Revenue</th>
                                    <th>Transaction Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($reports->count() > 0)
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{$report->custom_date}}</td>
                                            <td>{{$report->total_sales}}</td>
                                            <td>{{$report->t_n}}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                <tr><td>No record created</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if($reports->count() > 0)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Showing {{$reports->firstItem() - 1}} - {{$reports->lastItem()}} of {{$reports->total()}}</div>
                            <div>{{$reports->links()}}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>  
    </div>
@endsection