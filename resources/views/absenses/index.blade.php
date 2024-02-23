@extends('panel.layout.for_testing')

@section('content')
<section class="site-section flex items-center justify-center min-h-screen text-center text-white relative py-52 max-md:pb-16 max-md:pt-48 overflow-hidden" id="banner">
	
	<div class="container relative">
   <table class="table">
    <thead>
      <tr>
        <th>Absense Type</th>
        <th>Status</th>
        <th>On date</th>
      </tr>
    </thead>
    <tbody style="color:#000">
      
        @if(null != $absense_arr && count($absense_arr) > 0)
        @foreach($absense_arr as $val) 
        @php
        $add_selected = '';
        $show_msg = '';
        if($val['content'] != '') {
          $add_selected = 'selected_css';
          $show_msg = 'Absense';
        }
        @endphp
        <tr id="id_{{ $val['id']}}">
        <td class="selectable absense_msg {{$add_selected}}" data-id="{{$val['id']}}">{{ $val['section_name']}}</td>
        <td>{{ $val['status']}}</td>
        <td>{{ $val['created_at']}}</td>
        </tr>
        @endforeach
        @else
        <td col-span="3">No data found</td>
        @endif
     
    </tbody>
  </table>
</div>
<div class="popup" id="messagePopup">
  <div id="prev_content" class="prev_content"></div>
  <input type="hidden"  id="prev_id">
  <input type="hidden" id="selectedtextString">
    <textarea id="messageInput" placeholder="Enter your message"></textarea>
    <button id="submitButton" class="submit">Submit</button> <button id="closeButton" class="close">Close</button>
    <span class="error_msg"></span>
    <span class="success_msg"></span>
</div>
</section>


@endsection