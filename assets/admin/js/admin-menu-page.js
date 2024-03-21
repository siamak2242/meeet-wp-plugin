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
                }, data => input.checked = data)
                input.addEventListener('change', () => {
                    fetchPrimaryOption({
                        method: 'set',
                        token: token,
                        type: input.type,
                        value: input.checked
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