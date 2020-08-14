    var Ziggy = {
        namedRoutes: {"livewire.upload-file":{"uri":"livewire\/upload-file","methods":["POST"],"domain":null},"livewire.preview-file":{"uri":"livewire\/preview-file\/{filename}","methods":["GET","HEAD"],"domain":null},"telescope":{"uri":"telescope\/{view?}","methods":["GET","HEAD"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"listings":{"uri":"api\/listings","methods":["GET","HEAD"],"domain":null},"listings.create":{"uri":"listing\/create","methods":["GET","HEAD"],"domain":null},"listings.show":{"uri":"listing\/{listing}","methods":["GET","HEAD"],"domain":null},"categories":{"uri":"api\/categories","methods":["GET","HEAD"],"domain":null},"listings.prices":{"uri":"api\/listings\/prices","methods":["GET","HEAD"],"domain":null},"listings.search":{"uri":"listings\/search","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://localhost/',
        baseProtocol: 'http',
        baseDomain: 'localhost',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
