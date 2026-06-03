<x-mail::message>
{{-- Cabeçalho RUBYE --}}
<div style="text-align: center; border-bottom: 2px solid #000000; padding-bottom: 20px; margin-bottom: 30px;">
<h1 style="font-family: 'Courier New', Courier, monospace; font-size: 32px; font-weight: 900; tracking-widest: 0.2em; text-transform: uppercase; margin: 0; color: #000000;">RUBYE STORE</h1>
<p style="font-size: 9px; text-transform: uppercase; tracking: 0.3em; color: #a3a3a3; margin: 5px 0 0 0; font-weight: bold;">Autenticação & Segurança</p>
</div>

{{-- Conteúdo do E-mail --}}
<div style="font-family: sans-serif; color: #1a1a1a; line-height: 1.6; font-size: 13px; text-transform: uppercase; tracking: 0.05em;">
@foreach ($introLines as $line)
<p style="margin-bottom: 20px;">{{ $line }}</p>
@endforeach
</div>

{{-- Botão de Ação Brutalista (Forçado a ficar Preto) --}}
@isset($actionText)
<div style="text-align: center; margin: 35px 0;">
<table @style(['margin' => '0 auto'])>
<tr>
<td>
<a href="{{ $actionUrl }}" style="background-color: #000000; border: 1px solid #000000; color: #ffffff; display: inline-block; font-family: sans-serif; font-size: 12px; font-weight: bold; line-height: 50px; text-align: center; text-decoration: none; width: 260px; -webkit-text-size-adjust: none; text-transform: uppercase; letter-spacing: 0.2em; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
{{ $actionText }}
</a>
</td>
</tr>
</table>
</div>
@endisset

{{-- Mensagens Finais --}}
<div style="font-family: sans-serif; color: #666666; line-height: 1.6; font-size: 12px; text-transform: uppercase; margin-top: 30px; border-top: 1px solid #f3f3f3; pt: 20px;">
@foreach ($outroLines as $line)
<p>{{ $line }}</p>
@endforeach
</div>

{{-- Assinatura --}}
<div style="margin-top: 40px; text-align: center; font-family: sans-serif; font-size: 11px; text-transform: uppercase; color: #a3a3a3; letter-spacing: 0.1em;">
Atenciosamente,<br>
<strong style="color: #000000;">EQUIPE RUBYE</strong>
</div>

{{-- Subcopy Obrigatório da Rúbrica para Links Quebrados --}}
@isset($actionText)
<x-slot:subcopy>
<div style="font-size: 10px; text-transform: uppercase; color: #a3a3a3; line-height: 1.4;">
Se estiver com problemas para clicar no botão acima, copie e cole a URL abaixo no seu navegador:
<span class="break-all" style="font-family: monospace; color: #000000; display: block; margin-top: 5px;">{{ $actionUrl }}</span>
</div>
</x-slot:subcopy>
@endisset
</x-mail::message>