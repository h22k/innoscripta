export default function Figure({ children, className }){
  return(
    <figure className={className}>
      {children}
    </figure>
  );
}