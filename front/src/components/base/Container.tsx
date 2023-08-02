export default function Container({ children, ...rest }){

    return(
        <div {...rest}>
            {children}
        </div>
    );
}