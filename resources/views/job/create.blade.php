@extends('layouts.admin.main')

@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="h2">Create Job</div>
        <div class="col-md-8">
            <form action="{{route('job.store')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <label class="fw-bold" for="feature_image">Feature Image</label>
                    <input type="file" id="feature_image" name="feature_image" accept="image/*" class="form-control">
                </div>
                @error('feature_image')
                    <div class="text-danger fs-6">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label class="fw-bold" for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                @error('title')
                    <div class="text-danger fs-6">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label class="fw-bold" for="description">Description</label>
                    <textarea type="text" id="description" name="description" class="form-control summernote"></textarea>
                </div>
                @if($errors->has('description'))
                    <div class="text-danger fs-6">{{$errors->first('description')}}</div>
                @endif
                <div class="form-group">
                    <label class="fw-bold" for="roles">Roles and Responsibilities</label>
                    <textarea type="text" id="roles" name="roles" class="form-control summernote"></textarea>
                </div>
                @if($errors->has('roles'))
                    <div class="text-danger fs-6">{{$errors->first('roles')}}</div>
                @endif
                <div class="form-group">
                    <label class="fw-bold" for="">Job type</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="fulltime" value="Fulltime" name="job_type">
                        <label class="form-check-label" for="fulltime">Fulltime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="parttime" value="parttime" name="job_type">
                        <label class="form-check-label" for="parttime">Part time</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="casual" value="casual" name="job_type">
                        <label class="form-check-label" for="casual">Casual</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="contract" value="contract" name="job_type">
                        <label class="form-check-label" for="contract">Contract</label>
                    </div>
                </div>
                @if($errors->has('job_type'))
                    <div class="text-danger fs-6">{{$errors->first('job_type')}}</div>
                @endif
                <div class="form-group">
                    <label class='fw-bold' for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control">
                </div>
                @if($errors->has('address'))
                    <div class="text-danger fs-6">{{$errors->first('address')}}</div>
                @endif
                <div class="form-group">
                    <label class='fw-bold' for="enddate">Application end date</label>
                    <input type="date" id="enddate" name="enddate" class="form-control">
                </div>
                @if($errors->has('enddate'))
                    <div class="text-danger fs-6">{{$errors->first('enddate')}}</div>
                @endif
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                
                
            </form>

        </div>
    </div>
</div>
<style>
    .note-insert{
        display: none !important;
    }
</style>
@endsection