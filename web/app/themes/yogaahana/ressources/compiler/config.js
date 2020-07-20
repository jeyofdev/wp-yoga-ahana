module.exports = {
    context: 'assets',
    entry: {
        stylesApp: './styles/app.scss',
        stylesAdmin: './styles/admin.scss',
        scripts: './scripts/app.js'
    },
    devtool: 'cheap-module-eval-source-map',
    outputFolder: '../assets',
    publicFolder: 'assets',
    proxyTarget: 'http://localhost:8000/',
    watch: [
        '../**/*.php'
    ]
}