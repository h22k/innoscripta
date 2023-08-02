import A from '../base/A';
import Container from '../base/Container';
import Label from '../base/Label';
import List from '../base/List';
import ListElement from '../base/ListElement';

export default function FilterBy({ by }){

    const filterList = {
        date : [
            <ListElement>hakan</ListElement>
        ],

        category : [
            'daily',
            'important'
        ],

        source : [
            'bbc',
            'new york times'
        ]
    }

    return(
        <Container className="dropdown">
            <Label tabIndex={0} className="btn m-1 h-auto py-2 min-h-max">{by}</Label>
            <List tabIndex={0} className="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                {filterList[by].map((item, index) => (<ListElement key={index}><A>{item}</A></ListElement>))}
            </List>
        </Container>
    );
}
