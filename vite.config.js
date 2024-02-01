import { defineConfig } from 'vite';
import fs from 'fs';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
	// server: {
    //     // https: {
    //     // pfx: fs.readFileSync(path.resolve(__dirname, 'C:/Users/Long/Downloads/SSL/certificate.pfx')),
    //     // passphrase: '64cf880203ca31c7d1d25b83c686fdc0',
    //     // },
    //     // https: {
    //     //     key: fs.readFileSync(path.resolve(__dirname, 'C:/Users/Long/Downloads/SSL//privatekey.pem')),
    //     //     cert: fs.readFileSync(path.resolve(__dirname, 'C:/Users/Long/Downloads/SSL/certificate.pem')),
    //     // },
    //     https: {
    //         key: fs.readFileSync(path.resolve(__dirname, 'C:/Users/Long/Downloads/SSL/private.key')),
    //         cert: fs.readFileSync(path.resolve(__dirname, 'C:/Users/Long/Downloads/SSL/certificate.crt')),
    //         ca: fs.readFileSync(path.resolve(__dirname, 'C:/Users/Long/Downloads/SSL/ca_bundle.crt')),
    //     },
    // },
});