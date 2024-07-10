<div class="widget_tag_cloud ">                   
    <div class="tagcloud">
        @foreach ($responseNotes as $note)
            <a>{{$note->notes}}</a>
        @endforeach
    </div>
</div>