
@extends('candidate.layout.layout')
@section('body')
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-md-12">
         <div class="row">

         <div class="col-md-4 mb-3">
               <div class="card h-100">
                  <div class="card-header d-flex align-items-center justify-content-between pb-0">
                     <div class="card-title mb-0">
                        <h2 class="m-0 me-2">{{$question->word}}</h2>
                     </div>
                  </div>
               </div>
            </div>

            <div class="mb-3 col-md-8">
               
               <div class="row">
                  <div class="col-12 mb-4">
                     <div class="card">
                        <div class="card-header d-flex justify-content-between">
                           <div>
                              <h5 class="card-title mb-0">Possible Answers</h5>
                              <small class="text-muted">Check anwsers befor submitting</small>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-body">
                              
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Words</th>
                                 </tr>
                              </thead>
                              <tbody class="table-border-bottom-0" id="listanswer">
                                   
                              </tbody>
                              </table>


                           </div>
                        </div>
                        <div class="card" id="answer-list" url="{{ route('list.answer') }}" qid="{{$question->id}}">
                           <div class="card-body">
                              <form url="{{ route('check.answer') }}"  id="answer-check"
                                 enctype="multipart/form-data">
                                 @csrf
                                 <div class="form-group">
                                    <label>Permutations Word</label>
                                    <input type="text" name="word" class="form-control" placeholder="Please enter a Word">
                                 </div>
                                 <input type="hidden" value="{{$question->id}}" name="question_id">
                                 <div class="mt-2">
                                    <input type="submit" value="Search" class="btn btn-primary me-2" >
                                 </div>
                              </form>
                           </div>
                        </div>

                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</div>
  @endsection
  @push('css')

  @endpush
  @push('js')


<script type="text/javascript">
   $(document).ready(function(){
         $( '#answer-check' ).on('submit', function(e) {
         e.preventDefault();
         $.ajax({
            type: "POST",
            url: $('#answer-check').attr('url'),
            data: $(this).serialize(),
            success: function(result) {
               if(result.status=='success'){
                  answerlist();
               }else{
                  alert(result.message)
               }
            }

         });
      });

      answerlist();
      function answerlist(){
         var qid=$('#answer-list').attr('qid');
         var token=$('#answer-list').attr('token');
         $.ajax({
            type: "POST",
            url: $('#answer-list').attr('url'),
            data: {"qid":qid,"_token": "{{ csrf_token() }}"},
            success: function(result) {
               if(result.status=='success'){
                  var list=``;
                  $.each(result.data, function(key,val) {     
                        list+=`<tr> <td>`+val.word+`</td> </tr>`;        
                  });  
                   
               }else{
                  var list=``;
               }
               $('#listanswer').html(list);
            }

         });
         
      }
   });

</script>


  @endpush