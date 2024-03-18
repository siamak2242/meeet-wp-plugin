window.addEventListener('load', () => {
    const tabboxes = document.querySelectorAll('[data-lib-tabbing-el="root"]')
    tabboxes.forEach(tabbox => {
        const buttons = tabbox.querySelectorAll('[data-lib-tabbing-el="button"]')
        const contents = tabbox.querySelectorAll('[data-lib-tabbing-el="content"]')
        buttons.forEach((button, index) => {
            button.disabled = false
            button.addEventListener('click', () => {
                clicked(button)
                push_content(contents[index])
            })
        })
    })
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
})