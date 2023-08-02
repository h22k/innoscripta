import React from "react"

const Button = React.forwardRef((props, ref) => {
    const { children, ...rest } = props
    return (
        <button {...rest} ref={ref}>
            {children}
        </button>
    )
})

export default Button
