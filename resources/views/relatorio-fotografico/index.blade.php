<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} | Serviços Especializados de Engenharia Ltda.</title>
    <meta name="description" content="Serviços Especializados de Engenharia Ltda." />

    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.min.css" integrity="sha256-TYbLI7iEcpj/xvgetSyNT1Y077kszG89bszeY8cZLic=" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/pages/relatorio-fotografico.css" />
</head>

<body class="A4 relatorio-fotografico">

    {{-- Página 1/2 --}}
    <section class="sheet">

        {{-- Logo --}}
        @include('relatorio-fotografico/1_logo')

        {{-- Cabeçalho --}}
        @include('relatorio-fotografico/2_cabecalho')

        {{-- Equipe de Fiscalização Cliente --}}
        @include('relatorio-fotografico/3_equipe-cliente')

        {{-- Equipe Fibra Engenharia --}}
        @include('relatorio-fotografico/4_equipe-fibra')

        {{-- Documentações Expedidas no Dia --}}
        @include('relatorio-fotografico/5_documentacoes-expedidas')

        {{-- Atividades Realizadas no Dia --}}
        @include('relatorio-fotografico/6_atividades-realizadas')

        {{-- Problemas Encontrados --}}
        @include('relatorio-fotografico/7_problemas-encontrados')

        {{-- Informações Adicionais --}}
        @include('relatorio-fotografico/8_informacoes-adicionais')

        {{-- Observações --}}
        @include('relatorio-fotografico/9_observacoes')

        <footer>
            Página <b>1</b> de <b>2</b>
        </footer>

    </section>

    {{-- Página 2/2 --}}
    <section class="sheet">

        {{-- Logo --}}
        @include('relatorio-fotografico/1_logo')

        {{-- Cabeçalho --}}
        @include('relatorio-fotografico/2_cabecalho')

        {{-- Relatório Fotográfico --}}
        @include('relatorio-fotografico/10_relatorio-fotografico')

        {{-- Assinaturas --}}
        @include('relatorio-fotografico/11_assinaturas')

        <footer>
            Página <b>2</b> de <b>2</b>
        </footer>

    </section>

    <div class="info d-print-none">
        <p>
            <i>🖨️</i> Utilize papel A4<br>
            ao imprimir este formulário.
        </p>

        <button class="btn btn-dark btn-sm"
            onclick="window.print()">Imprimir</button>
    </div>

    @if (env('APP_ENV') === 'local')
        <script async src="http://localhost:3000/browser-sync/browser-sync-client.js?v=2.26.7"></script>
    @endif

</body>
</html>
