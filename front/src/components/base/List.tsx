export default function List({ children, ...rest }){
  return(
    <ul {...rest}>
      {children}
    </ul>
  );
}