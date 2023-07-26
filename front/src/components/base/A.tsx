export default function A({ children, to='#', ...rest }){
  return(
    <a href={to} {...rest}>
      {children}
    </a>
  );
}
