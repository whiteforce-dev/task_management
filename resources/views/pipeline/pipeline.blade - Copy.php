@extends('layouts.user_type.auth')
@section('content')
<div class="category" id="hold">
  <div class="card" data-status="1" draggable="true">Card 1 - Hold</div>
  <div class="card" data-status="1" draggable="true">Card 2 - Hold</div>
</div>
<div class="category" id="pending">
  <!-- Cards in pending category -->
</div>
<div class="category" id="progress">
  <!-- Cards in progress category -->
</div>
<div class="category" id="completed">
  <!-- Cards in completed category -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.card').on('dragstart', function(e) {
    e.originalEvent.dataTransfer.setData('text/plain', $(this).data('status'));
  });

  $('.category').on('dragover', function(e) {
    e.preventDefault();
  });

  $('.category').on('drop', function(e) {
    e.preventDefault();
    const status = e.originalEvent.dataTransfer.getData('text/plain');
    const card = document.querySelector('.dragging');
    if (card) {
      $(this).append(card);
      updateCardStatus(card, status, $(this).find('.card').length + 1);
    }
  });

  function updateCardStatus(card, oldStatus, newStatus) {
    // Send an AJAX request to update the card status in the backend (using Laravel).
    const cardId = $(card).attr('id'); // You need to set the card ID attribute.
    $.ajax({
      url: `/update-card-status/${cardId}`,
      type: 'PATCH',
      data: {
        oldStatus: oldStatus,
        newStatus: newStatus
      },
      success: function(response) {
        // Handle the response if needed.
      }
    });
  }
});
</script>



    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
@endsection
