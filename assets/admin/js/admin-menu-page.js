// lib => loading page
window.addEventListener('load', () => {
    const loading = document.getElementById('meeet-loading-page')
    loading.classList.add('fade-hide')
    setTimeout(() => {
        loading.style.display = 'none'
    }, 1000)
})

// lib => tabbing
window.addEventListener('load', () => {
    const tabboxes = document.querySelectorAll('[data-lib-tabbing-el="root"]')
    tabboxes.forEach(tabbox => {
        const default_tab = tabbox.getAttribute('data-lib-tabbing-default')
        const buttons = tabbox.querySelectorAll('[data-lib-tabbing-el="button"]')
        const contents = tabbox.querySelectorAll('[data-lib-tabbing-el="content"]')
        const clicked = button => {
            button.parentElement.querySelectorAll('button:disabled').forEach(button => {
                button.disabled = false
            })
            button.disabled = true
        }
        const push_content = content => {
            content.parentElement.querySelectorAll('._tabbing_el_active').forEach(content => {
                content.classList.remove('_tabbing_el_active')
            })
            content.classList.add('_tabbing_el_active')
        }
        buttons.forEach((button, index) => {
            button.disabled = false
            if (parseInt(default_tab) === index) {
                clicked(button)
                push_content(contents[index])
            }
            button.addEventListener('click', () => {
                clicked(button)
                push_content(contents[index])
            })
        })
    })
})

// lib => connect inputs to database
window.addEventListener('load', () => {
    const wpcontent = document.getElementById('wpcontent')
    const wpcontent_margin = getComputedStyle(wpcontent).padding
    const wpcontentEngine = input => {
        if (input.checked) {
            wpcontent.style.padding = wpcontent_margin
        } else {
            wpcontent.style.padding = 0
        }
    }

    const ajaxAdmin = document.querySelector('[data-admin-ajax]').getAttribute('data-admin-ajax')
    const inputs = document.querySelectorAll('[data-option-token]')
    inputs.forEach(input => {
        const token = input.getAttribute('data-option-token')
        const is_wpcontent_margin = input.id === 'meeet-wpcontent-margin'

        const fetchPrimaryOption = (entries, callback = null) => {
            input.disabled = true
            const body = new FormData()
            body.append('action', 'meeet_fetch_primary_option')
            for (const [key, value] of Object.entries(entries)) {
                body.append(key, value)
            }
            fetch(ajaxAdmin, {
                method: 'POST',
                body: body
            }).then(r => r.json()).then(data => {
                input.disabled = false
                if (callback)
                    callback(data)
            })
        }

        switch (input.type) {
            case 'checkbox':
                fetchPrimaryOption({
                    method: 'get',
                    token: token,
                }, data => {
                    input.checked = data
                    if (is_wpcontent_margin) {
                        wpcontentEngine(input)
                    }
                })
                input.addEventListener('change', () => {
                    fetchPrimaryOption({
                        method: 'set',
                        token: token,
                        type: input.type,
                        value: input.checked
                    }, () => {
                        if (is_wpcontent_margin)
                            wpcontentEngine(input)
                    })
                })
                break
            case 'text':
                fetchPrimaryOption({
                    method: 'get',
                    token: token,
                }, data => {
                    input.value = data
                    input.placeholder = data
                })

                input.addEventListener('change', () => {
                    fetchPrimaryOption({
                        method: 'set',
                        token: token,
                        value: input.value,
                    })
                })
        }

    })
})