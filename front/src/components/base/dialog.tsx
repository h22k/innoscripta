export default function Dialog({ children, ...rest }){
    return(
        <dialog {...rest}>
            {children}
        </dialog>
    );
}