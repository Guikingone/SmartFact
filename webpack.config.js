var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .enableVueLoader()
    .addEntry('vue', './assets/vue/main.js')
;

module.exports = Encore.getWebpackConfig();
