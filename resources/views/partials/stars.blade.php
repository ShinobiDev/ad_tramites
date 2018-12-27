@for($i=1;$i<=$ad->calificacion;$i++)
  @if($i<=5)
    <img  class="star" style="margin-left: 50px" src="{{asset('img/star.png')}}">
    @endif
@endfor