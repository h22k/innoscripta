export default function ListElement({ children, ...rest }){
  return(
    <li {...rest}>
      {children}
    </li>
  );
}