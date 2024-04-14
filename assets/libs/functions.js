function waitForElm(selector) {
    return new Promise(resolve => {
        if (document.querySelector(selector)) {
            resolve(document.querySelector(selector));
        }
        const observer = new MutationObserver(mutations => {
            if (document.querySelector(selector)) {
                observer.disconnect();
                resolve(document.querySelector(selector));
            }
        });
        observer.observe(document.documentElement, {
            childList: true,
            subtree: true
        });
    });
}
