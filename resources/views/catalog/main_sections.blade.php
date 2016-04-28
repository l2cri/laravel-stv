@foreach($sections as $key => $section)
    <div class="col-sm-6" style="margin-bottom: 40px;">
        <div class="information-blocks categories-border-wrapper">
            <h3><a href="{{ route('section.page', $section->code) }}">{{ $section->name }}</a></h3>
            <div class="article-container style-1">
                <ul>

                    @foreach($section->children as $child)
                        <li><a href="{{ route('section.page', $child->code) }}">{{ $child->name }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

    @if(($key+1) % 2 == 0)
        <div class="clearfix"></div>
    @endif
@endforeach