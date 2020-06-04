<section class="row mt-4">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-uppercase col">Relatório Fotográfico</th>
                </tr>
            </thead>
            <tbody class="no-border">
                <tr>
                    <td>

                        @foreach ($fotos as $foto)

                            <figure>
                                <img src="{{$foto->urlParaRelatorio}}"
                                    width="200"
                                    height="200" />

                            </figure>

                        @endforeach

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
