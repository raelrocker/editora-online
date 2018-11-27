<h3>{{config('app.name')}}</h3>
<p>Sua conta na plataforma foi criada</p>
<p>Usuário: <strong>{{$user->email}}</strong></p>
<p>
    <?php $link = route('codeeduuser.email-verification.check', $user->verification_token).'?email='.urlencode($user->email); ?>
    Clique aqui para verificar sua conta <a href="{{$link}}">{{$link}}</a>
</p>
<p>Observação: Não responda este e-mail, ele é gerado automaticamente.</p>