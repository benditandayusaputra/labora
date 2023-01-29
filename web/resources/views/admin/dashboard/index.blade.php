@extends('admin.layout.app')

@section('page', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-6 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $countClub }}</h3>
                <p>Total Club</p>
            </div>
            <div class="icon">
                <i class="ion ion-number"></i>
            </div>
            <a href="{{ route('club.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-6 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $countTournament }}</h3>
                <p>Total Turnamen</p>
            </div>
            <div class="icon">
                <i class="ion ion-number"></i>
            </div>
            <a href="{{ route('tournament.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>    
@endsection