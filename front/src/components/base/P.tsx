export default function P({ children, ...rest }){
    return(
        <p {...rest}>
            {children}
        </p>
    );
}