
     <p>Ola {{ $user->first_name}}, </p>
     <p>Seja Bem vindo (a) ao {{ config('app.name')}}. por favor, verifique o seu email no link abaixo.</p>

     <table role="presentation" border="0" cellpadding="0" cellpadding="0" class="btn btn-primary"> 
        <tbody>
            <tr>
                <td align="center">
                    <table role="presentation" border="0" cellpadding="0" >
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{ $verifyEmailLink }}" target="_blank">VERIFICAR E-MAIL</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
     </table>

     <P>OU, COPIE E COLA O LINK ABAIXO</P>
     <p>{{ $verifyEmailLink }}</p>
