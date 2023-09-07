<!DOCTYPE html>
<link rel="stylesheet" href="{{ url('assets/css/editor.css') }}">
<style>
    
</style>
<div class="modal-dialog modal-lg">
    <div class="modal-content"  style="overflow-X:hidden; overflow-Y:visible;">
        <div class="modal-header">
            <h4 class="modal-title">Edit Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>
        

        
        <div class="modal-body" >            

              
              
              
              <form action="{{ url('update-task', $task->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if ($errors->any())
                  <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                            {{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                    role="alert">
                    <span class="alert-text text-white">
                        {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
               
                @if(Auth::user()->can_allot_to_others == '1')
                <div class="row">                           
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Task name') }}</label>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $task->task_name }}" type="text"
                                    placeholder="Task Name" id="task-name" name="task_name">
                                @error('task_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @php
                      $selectedIDs = explode(',', $task->alloted_to);
                      $users = \App\Models\User::select('id', 'name')->get();
                      foreach ($users as $user) {
                          $options[] = [
                              'id' => $user->id,
                                'name' => $user->name,
                                'selected' => in_array($user->id, $selectedIDs),
                            ];
                        }
                    @endphp                         
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.type" class="form-control-label">{{ __('Alloted to') }}</label>
                                <div class="@error('user.type')border border-danger rounded-3 @enderror">                                       
                                        <select class="selectpicker form-control" multiple data-live-search="true" name="alloted_to[]">                                           
                                            @foreach ($options as $option)
                                            <option value="{{ $option['id'] }}" {{ $option['selected'] ? 'selected' : '' }}>
                                                {{ $option['name'] }}
                                            </option>
                                            @endforeach
                                    </select>
                                    @error('type')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>                         
                 </div>
                 @else<div class="row">                           
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Task name') }}</label>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $task->task_name }}" type="text"
                                    placeholder="Task Name" id="task-name" name="task_name">
                                @error('task_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Start date') }}</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $task->start_date }}" type="date" name="task_date">
                                @error('task_date')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about">{{ 'Deadline date' }}</label>
                            <div class="@error('user.EndDate')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $task->deadline_date }}" type="date"
                                    placeholder="@example.com" id="deadline_date" name="deadline_date">
                                @error('enddate')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about">{{ 'Status' }}</label>
                            <div class="@error('user.status')border border-danger rounded-3 @enderror">
                                <select class="form-control" name="status">
                                    <option value="">--select--</option>
                                    @foreach ($status as $statu)                                       
                                    <option value="{{ $statu->id }}"{{ $statu->id == $task->status ? 'selected' : '' }}>{{ $statu->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">                                                         
                        <div class="form-group">
                            <label for="user.team_comments"
                                class="form-control-label">{{ __('Priority') }}</label>
                            <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                <select name="priority" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1" {{ '1' == $task->priority ? 'selected' : '' }}>Highest</option>
                                    <option value="2" {{ '2' == $task->priority ? 'selected' : '' }}>High</option>
                                    <option value="3" {{ '3' == $task->priority ? 'selected' : '' }}>Medium</option>
                                    <option value="4" {{ '4' == $task->priority ? 'selected' : '' }}>Low</option>
                                </select>
                                @error('priority')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>                              
                    </div>

                    <div class="row">
                        <div class="col-md-12">                                                             
                            <div class="form-group">
                                <label for="user.team_comments" class="form-control-label">{{ __('Task details') }}</label>
                                <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" rows="3" placeholder="Task deatils..." name="task_details">{{ $task->task_details }}</textarea>
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>                                    
                        </div>
                    </div>
                   
                    <input type="hidden" name="managerId" value="{{ $task->alloted_by }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn bg-primary text-white">Update Task</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/thgk8f0to7oi2t6derx6bol4wejbnd7ngq0zaenp7yzt5p1s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
    });
  </script>
  </html>






