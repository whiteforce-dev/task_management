@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/pipeline/new.css') }}" />

    <body style="font-family: Poppins, sans-serif">
        <div class="app">
            <main class="project">
                <div class="heading">
                    <div class="first-heading">
                        <h2 style="color: #CB0C9F">Task Board</h2>
                    </div>
                    <div class="create">
                      <a href="javascript:" class="btn btn-primary" onclick="createTask('{{ url('create-task') }}')" style="margin-top: 15px;">New task</a>
                    </div>
                </div>
                <div class="project-tasks">
                    <div class="project-column firstcolumn" data-count="1">
                        <div class="project-column-heading">
                            <h2 class="project-column-heading__title">Pending Task</h2>
                        </div>
                        <div class="category" id="pending">
                        @foreach ($pendingtasks as $pendingtask)
                            <div class="task firstcard card" draggable="true" data-id="1" >
                                <div class="uper">
                                    <h4>{{ ucfirst($pendingtask->task_name) }}</h4>
                                    <div class="dropdown">
                                        <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-content">

                                            @foreach ($stages as $status)
                                                @if ($status->status !== 'pending')
                                                    <a href="javascript:void(0);"
                                                        onclick="selectstatus11({{ $pendingtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                @endif
                                            @endforeach
                                            <a href="{{ url('sendtask-email', $pendingtask->id) }}">SendEmail</a>
                                        </div>
                                    </div>
                                </div>
                                @php $taskname = mb_strimwidth($pendingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                <p><span>Task: </span>{{ $taskname }}</p>
                                <p><span>Start:
                                    </span>{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}</p>
                                <div class="preimg">
                                    <p><span>Deadline:
                                        </span>{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}</p>
                                    <div class="imgbox">
                                        <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="project-column secondcolumn" data-count="2">
                        <div class="project-column-heading-02">
                            <h2 class="project-column-heading__title">In Progress</h2>
                        </div>
                      <div class="category" id="progress">
                        @foreach ($progresstasks as $progresstask)
                            <div class="task secondcard card" draggable="true" >
                                <div class="uper">
                                    <h4>{{ $progresstask->task_name }}</h4>
                                    <div class="dropdown">
                                        <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-content">

                                            @foreach ($stages as $status)
                                                @if ($status->status !== 'progress')
                                                    <a href="javascript:void(0);"
                                                        onclick="selectstatus11({{ $progresstask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                @endif
                                            @endforeach
                                            <a href="{{ url('sendtask-email', $progresstask->id) }}">SendEmail</a>
                                        </div>
                                    </div>
                                </div>
                                @php $taskname = mb_strimwidth($progresstask->task_name ?? 'null', 0, 20, '...'); @endphp
                                <p><span>Task: </span>{{ $taskname }}</p>
                                <p><span>Start:</span>{{ \Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y') }}</p>
                                <div class="preimg">
                                    <p><span>Deadline:</span>{{ \Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y') }}</p>
                                    <div class="imgbox">
                                        <img src="{{ url($progresstask->userGet->image ?? 'NA') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                      </div>
                    </div>

                    <div class="project-column thirdcolumn" data-count="3">
                        <div class="project-column-heading-03">
                            <h2 class="project-column-heading__title">Hold Task</h2>
                        </div>
                      <div class="category" id="holding">
                        @foreach ($holdingtasks as $holdingtask)
                            <div class="task thirdcard card" draggable="true" >
                                <div class="uper">
                                    <h4>{{ $holdingtask->task_name }}</h4>
                                    <div class="dropdown">
                                        <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-content">
                                            @foreach ($stages as $status)
                                                @if ($status->status !== 'hold')
                                                    <a href="javascript:void(0);"
                                                        onclick="selectstatus11({{ $holdingtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                @endif
                                            @endforeach

                                            <a href="{{ url('sendtask-email', $holdingtask->id) }}">SendEmail</a>
                                        </div>
                                    </div>
                                </div>
                                @php $taskname = mb_strimwidth($holdingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                <p><span>Task: </span>{{ $taskname }}</p>
                                <p><span>Start:
                                    </span>{{ \Carbon\Carbon::parse($holdingtask->start_date)->format('d-m-Y') }}</p>
                                <div class="preimg">
                                    <p><span>Deadline:
                                        </span>{{ \Carbon\Carbon::parse($holdingtask->deadline_date)->format('d-m-Y') }}
                                    </p>
                                    <div class="imgbox">
                                        <img src="{{ url($holdingtask->userGet->image ?? 'NA') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                      </div>
                    </div>

                    <div class="project-column fourthcolumn" data-count="4">
                        <div class="project-column-heading-04">
                            <h2 class="project-column-heading__title">Completed</h2>
                        </div>
                       <div class="category" id="completed">
                        @foreach ($completedtasks as $completedtask)
                            <div class="task forthcard card" draggable="true" >
                                <div class="uper">
                                    <h4>Priya Shrivastava</h4>
                                    <div class="dropdown">
                                        <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-content">
                                            @foreach ($stages as $status)
                                                @if ($status->status !== 'hold')
                                                    <a href="javascript:void(0);"
                                                        onclick="selectstatus11({{ $completedtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                @endif
                                            @endforeach

                                            <a href="{{ url('sendtask-email', $completedtask->id) }}">SendEmail</a>
                                        </div>
                                    </div>
                                </div>
                                @php $taskname = mb_strimwidth($holdingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                <p><span>Task: </span>{{ $taskname }}</p>
                                <p><span>Start:
                                    </span>{{ \Carbon\Carbon::parse($holdingtask->start_date)->format('d-m-Y') }}</p>

                                <div class="preimg">
                                  @if($completedtask->status == "4")
                                    <p><span>EndDate:</span>{{ \Carbon\Carbon::parse($completedtask->end_date)->format('d-m-Y') }}</p>
                                    @else
                                    <p><span>Deadline - </span>{{ \Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y') }}</p>
                                    @endif
                                    <div class="imgbox">
                                        <img src="{{ url($holdingtask->userGet->image ?? 'NA') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                       </div>
                    </div>
                </div>
        </div>
        </div>
        </main>
        </div>

<script>
  const cards = document.querySelectorAll('.card');
cards.forEach(card => {
  card.addEventListener('dragstart', dragStart);
  card.addEventListener('dragend', dragEnd);
});

function dragStart() {
  this.classList.add('dragging');
}

function dragEnd() {
  this.classList.remove('dragging');
}

const categories = document.querySelectorAll('.category');

categories.forEach(category => {
  category.addEventListener('dragover', dragOver);
  category.addEventListener('dragenter', dragEnter);
  category.addEventListener('dragleave', dragLeave);
  category.addEventListener('drop', drop);
});

function dragOver(e) {
  e.preventDefault();
}

function dragEnter(e) {
  e.preventDefault();
  this.classList.add('drag-over');
}

function dragLeave() {
  this.classList.remove('drag-over');
}

function drop() {
  const card = document.querySelector('.dragging');
  this.appendChild(card);
  this.classList.remove('drag-over');
 const cardId = card.getAttribute('data-card-id');
const newStatus = this.getAttribute('data-status');

updateCardStatus(cardId, newStatus);
}

function updateCardStatus(cardId, newStatus) {

  $.ajax({
    url: `/update-card-status/${cardId}`,
    type: 'PATCH',
    data: {
      newStatus: newStatus
    },
    success: function(response) {
      // Handle the response if needed.
    }
  });
}

</script>
        
        {{-- <script src="{{ url('assets/pipeline/new.js') }}"></script> --}}
        <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    
        <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    @endsection
