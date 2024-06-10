
@extends('candidate.layout.layout')
@section('body')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
    <h5 class="card-header">Permutation Questions List</h5>

   
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Words</th>
            <th>Score</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($lists as $list)
            <tr>
               <td>{{ $list->word }}</td>
                <td>{{ $list->answers_sum_points }}</td>
                <td>
                    <a href="{{ route('attend.questions',encrypt($list->id))}}">
                        <button type="button" class="btn btn-xs btn-outline-success"><i class="bx bx-edit me-1"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>
  @endsection
  @push('css')

  @endpush
  @push('js')
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  @endpush