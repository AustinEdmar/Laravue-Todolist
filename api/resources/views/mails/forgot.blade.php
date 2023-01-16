
     <p>Ola {{ $user->first_name}}, </p>
     <p>Vc requisitou a alteracao de senha da sua conta{{ config('app.name')}}. caralho clica no link abaixo.</p>

     <table role="presentation" border="0" cellpadding="0" cellpadding="0" class="btn btn-primary"> 
        <tbody>
            <tr>
                <td align="center">
                    <table role="presentation" border="0" cellpadding="0" >
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{ $resetPasswordLink }}" target="_blank">REDEFINIR SENHA</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
     </table>

     <P>OU, simplesmente copie e cole o link abaixo em seu navegador</P>
     <p>{{ $resetPasswordLink }}</p>
