@guest
@else
    <nav class="navbar navbar-light navbar-expand-sm navigation-clean" style="background: rgba(255,255,255,0);box-shadow: 11px 9px 17px 0px rgba(78,115,223,0.13);margin-bottom: 20px;">
        <div class="container">
            <a class="navbar-brand" href="#"  onclick="ocultarMenu(event);"><i class="fas fa-bars"></i></a>
            <h6 id="teacher" class="teacher" style="margin: 0;">Usuario {{ Auth::user()->name}}</h6>
        </div>
    </nav>
@endguest
