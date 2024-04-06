@extends('layouts.admin.main')

@section('content')


<div class="container-fluid mt-3">
  <div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
          <svg class="bi">
            <use xlink:href="#calendar3" />
          </svg>
          This week
        </button>
      </div>
    </div>
    <div class="col-12 text-center">
      Hello {{auth()->user()->name}} <br>
      @if(auth()->user()->user_type == 'employer')
      @if(auth()->user()->billing_ends === null)
      @php
      $isExpired = now() > auth()->user()->user_trial
      @endphp
      <div class="alert alert-{{$isExpired ? 'danger' : 'warning'}}" role="alert">Your trial account {{$isExpired ? 'was expired' : 'will expire'}} on <span class="fw-bold">{{auth()->user()->user_trial }}</span></div>
      @else
      @php
      $isExpired = now() > auth()->user()->billing_ends
      @endphp
      <div class="{{$isExpired ? 'alert alert-warning' : 'fw-bold'}}" role="alert">Your membership {{$isExpired ? 'was expired' : 'will expire'}} on <span class="fw-bold">{{auth()->user()->billing_ends }}</span></div>
      @endif
      @endif
    </div>

    <!-- $isExpired = now()->greaterThan(auth()->user()->user_trial); -->

    <!-- card counter -->
    <div class="col-12 mt-3">
      <div class="container">
        @include('layouts.message')
        <div class="row">
          <div class="col-md-3 col-6">
            <a href="">
              <div class="card-counter primary">
                <i class="fa fa-code-fork"></i>
                <i class="count-numbers fa fa-user"></i>
                <span class="count-name">User profile</span>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-6">
            <a href="">
              <div class="card-counter danger">
                <i class="fa fa-ticket"></i>
                <span class="count-numbers">342</span>
                <span class="count-name">Applications</span>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-6">
            <a href="">
              <div class="card-counter success">
                <i class="fa fa-database"></i>
                <span class="count-numbers">6875</span>
                <span class="count-name">All jobs</span>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-6">
            <a href="">
              <div class="card-counter info">
                <i class="fa fa-users"></i>
                <div class="count-numbers">&plus;</div>
                <div class="count-name">Post job</div>
              </div>
            </a>
          </div>

          <main class="col-md-9 mx-auto col-lg-11 px-md-4">

            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

            <h2>Section title</h2>
            <div class="table-responsive small">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>1,002</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>data</td>
                    <td>rich</td>
                    <td>dashboard</td>
                    <td>tabular</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>information</td>
                    <td>placeholder</td>
                    <td>illustrative</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,004</td>
                    <td>text</td>
                    <td>random</td>
                    <td>layout</td>
                    <td>dashboard</td>
                  </tr>
                  <tr>
                    <td>1,005</td>
                    <td>dashboard</td>
                    <td>irrelevant</td>
                    <td>text</td>
                    <td>placeholder</td>
                  </tr>
                  <tr>
                    <td>1,006</td>
                    <td>dashboard</td>
                    <td>illustrative</td>
                    <td>rich</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,007</td>
                    <td>placeholder</td>
                    <td>tabular</td>
                    <td>information</td>
                    <td>irrelevant</td>
                  </tr>
                  <tr>
                    <td>1,008</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>1,009</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                  </tr>
                  <tr>
                    <td>1,010</td>
                    <td>data</td>
                    <td>rich</td>
                    <td>dashboard</td>
                    <td>tabular</td>
                  </tr>
                  <tr>
                    <td>1,011</td>
                    <td>information</td>
                    <td>placeholder</td>
                    <td>illustrative</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,012</td>
                    <td>text</td>
                    <td>placeholder</td>
                    <td>layout</td>
                    <td>dashboard</td>
                  </tr>
                  <tr>
                    <td>1,013</td>
                    <td>dashboard</td>
                    <td>irrelevant</td>
                    <td>text</td>
                    <td>visual</td>
                  </tr>
                  <tr>
                    <td>1,014</td>
                    <td>dashboard</td>
                    <td>illustrative</td>
                    <td>rich</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,015</td>
                    <td>random</td>
                    <td>tabular</td>
                    <td>information</td>
                    <td>text</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
<style>
  .card-counter {
    position: relative;
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover {
    box-shadow: 4px 4px 20px #3b3b3b;
    transition: .2s linear all;
  }

  .card-counter.primary {
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger {
    background-color: #ef5350;
    color: #FFF;
  }

  .card-counter.success {
    background-color: #66bb6a;
    color: #FFF;
  }

  .card-counter.info {
    background-color: #26c6da;
    color: #FFF;
  }

  .card-counter i {
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers {
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name {
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.8;
    display: block;
    font-size: 18px;
  }
</style>