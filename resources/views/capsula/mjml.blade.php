<mjml>
  <mj-head>
    <mj-attributes>
      <mj-all padding="0px"></mj-all>
      <mj-class name="preheader" color="#cccccc" font-size="11px" font-family="Ubuntu, Helvetica, Arial, sans-serif" padding="0 20px"></mj-class>
      <mj-class name="cta" color="#FFFFFF" font-size="13px" border-radius="3px" href="https://mjml.io" font-family="Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif" padding="20px 25px"></mj-class>
      <mj-class name="footer-text" align="center" color="#ffffff" font-family="Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif" font-size="15px" padding="0 25px"></mj-class>
      <mj-navbar-link padding="0 35px" font-weight="bold" font-size="12px"></mj-navbar-link>
    </mj-attributes>
    <mj-style inline="inline">a { text-decoration: none; color: inherit; }</mj-style>
  </mj-head>
  <mj-body background-color="#000000">
    <mj-section padding-bottom="10px" padding-top="10px">
      <mj-group>
        <mj-column>
          <mj-text mj-class="preheader"><a href="https://capsula.uniandes.edu.co">La Cápsula del tiempo</a></mj-text>
        </mj-column>
      </mj-group>
    </mj-section>
    <mj-section background-color="#000000">
      <mj-column>
        <mj-image src="{{asset('img/logoUniandes.png')}}" alt="Logo Uniandes" align="center" width="105px"></mj-image>
      </mj-column>
    </mj-section>
    <mj-section background-color="#000000" padding="10px 0">
      <mj-column width="100%" vertical-align="bottom">
        <mj-text align="center" color="#ffffff" font-family="Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif" font-size="18px"><p>Un mensaje de tu 'yo' del pasado...</p><p>Ha viajado en el tiempo y llega a ti un año después...</p></mj-text>
      </mj-column>
    </mj-section>
    <mj-section background-color="#000000" padding="20px 0">
      <mj-column>
        <mj-text align="center" color="#ffee00" font-family="Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif" font-size="18px" padding="0 25px" font-weight="bold">
          <p>{{$capsula->mensaje}}</p>
        </mj-text>
      </mj-column>
      <mj-column>
        <mj-image src="{{asset('storage/' . $image)}}" alt="Maldives, Corse : -15%" width="240px"></mj-image>
        <mj-button href="{{route('pods.host')}}/{{$capsula->id}}" mj-class="cta" background-color="#222">Verlo en el explorador</mj-button>
      </mj-column>
    </mj-section>
    <mj-section background-color="#000">
      <mj-column width="33.33333333333333%">
        <mj-image src="{{asset('img/logoUniandes.png')}}" alt="Call us : 0 800 123 456" width="97px" padding="10px 25px"></mj-image>
      </mj-column>

    </mj-section>
    <mj-section padding="20px 0">
      <mj-column>
        <mj-text align="center" color="#777" font-size="11px">Universidad de los Andes, Colombia
          <p>DSIT</p>
        </mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
