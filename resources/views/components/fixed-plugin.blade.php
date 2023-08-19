{{-- <?php
use Illuminate\Support\Facades\Auth;
?>
<style>
    .table1 {
        overflow-y: scroll;
        height: 1000px;
        display: block;
    }
</style>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-primary position-fixed px-3 py-2">
        <i class="fas fa-comment py-2"> </i>
    </a>
    <div class="card shadow-sm ">
        <div class="card-header pb-0 pt-3 ">
            <div class="{{ Request::is('rtl') ? 'float-end' : 'float-start' }}">
                {{-- <span class="btn btn-outline-primary btn-sm">Chat with team</span> 
            </div>
            <div class="{{ Request::is('rtl') ? 'float-start mt-4' : 'float-end mt-4' }}">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
        </div>
        @if (Auth::user()->type == 'manager')
            <table width="100%" class="table1">
                @php
                    $team_id = \App\Models\User::where('parent_id', Auth::user()->id)
                        ->pluck('id')
                        ->ToArray();
                    $chatdata = \App\Models\Chatbox::whereIn('chatId', $team_id)->get();
                @endphp
                @foreach ($chatdata as $chat)
                    <tr>
                        <td colspan="2" align="left" valign="bottom">{{ $chat->chat }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <table width="100%" class="table1">
                @php
                    $chatdata = \App\Models\Chatbox::where('chatId', Auth::user()->parent_id)->get();
                @endphp
                @foreach ($chatdata as $chat)
                    <tr>
                        <td colspan="2" align="left" valign="bottom">{{ $chat->chat }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <div>
            @if (Auth::user()->type == 'manager')
                <form action="{{ url('managerchat', Auth::user()->id) }}" name="managerchat" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control" id="about" rows="3" placeholder="Comments by manager..." name="managerchat"></textarea>
                            <div class="d-flex justify-content-right mt-4">
                                <button type="submit" class="btn btn-primary">{{ 'SEND' }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <form action="{{ url('teamchat', Auth::user()->id) }}" name="teamchat" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control" id="about" rows="3" placeholder="Comments by team..." name="teamchat"></textarea>
                            <div class="d-flex justify-content-right mt-4">
                                <button type="submit" class="btn btn-primary"
                                    style="float:right">{{ 'SEND' }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>


    </div>
</div>
</div> --}}
