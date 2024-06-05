@props(['name','value'=>''])
<x-input-wrapper>
    <x-label :name="$name"/>
    <textarea
    name="{{$name}}"
    id="{{$name}}"
    cols="30"
    rows="10"
    class="form-control"
    >
    {{old($name,$value)}}
    </textarea>
    <x-error name="{{$name}}"/>
</x-input-wrapper>