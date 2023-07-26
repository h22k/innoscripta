export default function H2({ className, children, ...rest }){
  return(
    <h2 className={className} {...rest}>
      {children}
    </h2>
  );
}