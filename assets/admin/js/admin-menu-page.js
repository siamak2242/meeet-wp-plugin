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
    const ajaxAdmin = document.querySelector('[data-admin-ajax]').getAttribute('data-admin-ajax')
    const inputs = document.querySelectorAll('[data-option-token]')
    inputs.forEach(input => {
        const token = input.getAttribute('data-option-token')
        const type = input.type

        const fetchPrimaryOption = (mode, entries, callback) => {
            const body = new FormData()
            if (mode === 'get') {
                mode = 'meeet_get_primary_option'
            } else if (mode === 'set') {
                mode = 'meeet_set_primary_option'
            } else {
                throw new Error('invalid mode')
            }
            body.append('action', mode)
            for (const [key, value] of Object.entries(entries)) {
                body.append(key, value)
            }
            fetch(ajaxAdmin, {
                method: 'POST',
                body: body
            }).then(r => r.json()).then(data => callback(data))
        }

        fetchPrimaryOption('get', {
            token: token,
            value_type: 'boolean',
        }, (data) => {
            console.log(data)
        })
    })
})