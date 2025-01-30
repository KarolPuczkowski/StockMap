var config = {
    paths: {
        'leaflet': 'https://unpkg.com/leaflet/dist/leaflet',
        'leaflet.markercluster': 'https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster'
    },
    shim: {
        'leaflet': {
            exports: 'L'
        },
        'leaflet.markercluster': {
            deps: ['leaflet'],
            exports: 'L'
        }
    }
};
