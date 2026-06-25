@extends('layouts.admin')
@section('title', '| Job Applications')
@section('page_name', 'Job Applications')
@section('section_name', 'Job Applications List')


@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@yield('page_name')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('careers.index') }}">Careers</a></li>
            <li class="breadcrumb-item active">Applications</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-file-alt"></i>
                @yield('section_name')
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Filter Form -->
              <form method="GET" action="{{ route('careers.applications') }}" class="mb-4">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="career_id">Filter by Job Position</label>
                      <select name="career_id" id="career_id" class="form-control">
                        <option value="">All Jobs</option>
                        @foreach($careers as $career)
                          <option value="{{ $career->id }}" {{ $selectedCareer == $career->id ? 'selected' : '' }}>
                            {{ $career->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>&nbsp;</label>
                      <div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('careers.applications') }}" class="btn btn-secondary">Reset</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>

              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif

              <table id="applications-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Job Position</th>
                    <th>Applicant Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Resume</th>
                    <th>Applied Date</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($applications as $application)
                  <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->career->name ?? 'N/A' }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->phone }}</td>
                    <td>
                      @if($application->resume_path)
                        <a href="{{ asset($application->resume_path) }}" target="_blank" class="btn btn-sm btn-info">
                          <i class="fas fa-download"></i> Download
                        </a>
                      @else
                        <span class="text-muted">No resume</span>
                      @endif
                    </td>
                    <td>{{ $application->created_at->format('Y-m-d H:i:s') }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center">No applications found.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<script type="text/javascript">
  $(function() {
    $("#applications-table").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "order": [[6, "desc"]], // Sort by date descending
      "pageLength": 25
    });
  });
</script>

@endsection

