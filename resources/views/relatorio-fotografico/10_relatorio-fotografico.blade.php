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
                        
                        @foreach ($manutencaoCivilEletrica->fotos->pluck('URLParaRelatorio')->all() as $foto)
                            
                            <figure>
                                <img src="{{$foto}}"
                                    width="200"
                                    height="200" />

                                {{-- <figcaption>Exemplo de caption</figcaption> --}}
                            </figure>

                        @endforeach                       
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
