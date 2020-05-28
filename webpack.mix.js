const mix = require('laravel-mix')
const bsFiles = ['public/css/**/*.{css,js}']

mix.js('resources/js/App.js', 'public/js')
  .js('resources/js/pages/Cidades.js', 'public/js/pages')
  .js('resources/js/pages/Plantas.js', 'public/js/pages')
  .js('resources/js/pages/MateriaisItem.js', 'public/js/pages')
  .js('resources/js/pages/Estoque.js', 'public/js/pages')
  .js('resources/js/pages/EntradaMateriais.js', 'public/js/pages')
  .js('resources/js/pages/QuantidadesMinimas.js', 'public/js/pages')
  .js('resources/js/pages/QuantidadesSubstituidas.js', 'public/js/pages')
  .js('resources/js/pages/Comentarios.js', 'public/js/pages')
  .js('resources/js/pages/ComentariosGerais.js', 'public/js/pages')
  .js('resources/js/pages/Materiais.js', 'public/js/pages')
  .js('resources/js/pages/Programacao.js', 'public/js/pages')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/pages/login.scss', 'public/css/pages')
  .sass('resources/sass/pages/welcome.scss', 'public/css/pages')
  .sass('resources/sass/pages/relatorio-fotografico.scss', 'public/css/pages')

if (!mix.inProduction()) {
  mix.webpackConfig({ devtool: 'source-map' })
    .sourceMaps()
    .disableNotifications()
    .browserSync({
      files: process.env.LIVERELOAD_PHP
        ? ['{app,config,public,resources/views}/**/*.php', ...bsFiles]
        : bsFiles,
      proxy: 'localhost',
      logSnippet: false,
      notify: false,
      open: false,
      port: 3000,
      ui: false
    })
}

// if (mix.inProduction()) {
mix.version()
// }
