import Image from '../base/Image';
import userImage from '../../assets/user.png'

// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
export default function Avatar({ src, ...rest }){
  return(
      // eslint-disable-next-line @typescript-eslint/no-unsafe-assignment
    <Image src={!src ? userImage : src} {...rest} />

  );
}
